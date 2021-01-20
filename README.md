# drone-ci-sonarqube-phpcs-pipeline

##### docker-compose.yml
```
version: '3.7'
services:
  drone-server:
    container_name: drone_server
    image: drone/drone:1
    ports:
      - 8888:80
    volumes:
      - /var/lib/drone:/data
      - /var/run/docker.sock:/var/run/docker.sock
    restart: always
    environment:
      - DRONE_GITEA_SERVER=gitea_host_url_with_http
      - DRONE_GITEA_CLIENT_ID=93cd8605-bfcc-44f2-b542-5fff34ce3d69
      - DRONE_GITEA_CLIENT_SECRET=eZgkmoaPfgrqwtk2wksOcb-wGsQZEcMUNlHkAjwyehA=
      - DRONE_RPC_SECRET=3e9601abdfdd1a06a3cac35a3e10beb5
      - DRONE_SERVER_HOST=drone_host_without_http
      - DRONE_SERVER_PROTO=http
      - DRONE_LOGS_TRACE=true
      - DRONE_LOGS_PRETTY=true
      - DRONE_LOGS_COLOR=true
  drone-agent:
    container_name: drone_agent
    image: drone/agent:1
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock
    restart: always
    depends_on:
      - drone-server
    environment:
      - DRONE_RPC_HOST=drone-server
      - DRONE_RPC_SECRET=3e9601abdfdd1a06a3cac35a3e10beb5
      - DRONE_RUNNER_CAPACITY=1
      - DRONE_RUNNER_NAME=custom_name
      - DRONE_LOGS_TRACE=true
      - DRONE_LOGS_PRETTY=true
      - DRONE_LOGS_COLOR=true
  sonarqube:
    image: sonarqube:community
    ports:
      - 9000:9000
    environment:
      - sonar.jdbc.url=jdbc:postgresql://postgres:5432/sonar
      - sonar.jdbc.username=sonar
      - sonar.jdbc.password=sonar
      - sonar.search.javaAdditionalOpts=-Dbootstrap.system_call_filter=false
    ulimits:
      nofile:
        soft: 65536
        hard: 65536
    volumes:
      - ./sonarqube/logs:/opt/sonarqube/logs
      - ./sonarqube/data:/opt/sonarqube/data
      - ./sonarqube/extensions:/opt/sonarqube/extensions
  postgres:
    image: postgres
    environment:
      - POSTGRES_USER=sonar
      - POSTGRES_PASSWORD=sonar
    ports:
      - '5432:5432'
    ulimits:
      nofile:
        soft: 65535
        hard: 65536
    volumes:
      - ./postgres-data:/var/lib/postgresql/data
```
drone server config(nginx: **/etc/nginx/conf.d/drone.test.conf**):
```
upstream drone {
    server 127.0.0.1:8888;
}
    
server {
    listen 80;
    server_name drone.test;

    location / {
        proxy_pass http://drone;
        proxy_connect_timeout       300;
        proxy_send_timeout          300;
        proxy_read_timeout          300;
        send_timeout                300;
    }
    
    error_log /var/log/nginx/drone.test.error.log;
    access_log /var/log/nginx/drone.test.access.log;
}
```
sonarqube server config(nginx: **/etc/nginx/conf.d/sonar.test.conf**):
```
upstream sonar {
    server 127.0.0.1:9000;
}

server {
    listen 80;
    server_name sonar.test;

    client_max_body_size 20M;

    location / {
        proxy_pass http://sonar;
    	  proxy_set_header Host            $host;
   	    proxy_set_header X-Forwarded-For $remote_addr;
        proxy_connect_timeout       300;
        proxy_send_timeout          300;
        proxy_read_timeout          300;
        send_timeout                300;
    }

    error_log /var/log/nginx/sonar.test.error.log;
    access_log /var/log/nginx/sonar.test.access.log;
}

```

create **.drone.yml** file in root directory of project
```
kind: pipeline
name: default
steps:
- name: psr-check
  image: herloct/phpcs
  commands:
  - >
    phpcs -d memory_limit=500M --standard=PSR1,PSR2 --ignore=/vendor/ /drone/src/app
- name: sonarqube
  image: sonarsource/sonar-scanner-cli
  commands:
  - >
    sonar-scanner
    -Dsonar.host.url=sonar_host
    -Dsonar.login=soanrqube_login_token
    -Dsonar.projectKey=${DRONE_REPO_OWNER}:${DRONE_REPO_NAME}
    -Dsonar.projectName=${DRONE_REPO_OWNER}:${DRONE_REPO_NAME}
    -Dsonar.projectVersion=${DRONE_TAG}
    -Dsonar.projectBaseDir=.
    -Dsonar.sourceEncoding=UTF-8
    -Dsonar.buildbreaker.skip=false
    -Dsonar.qualitygate.wait=true
```
