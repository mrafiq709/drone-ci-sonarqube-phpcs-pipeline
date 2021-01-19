# drone-ci-sonarqube-phpcs-pipeline

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
    -Dsonar.login=login_key
    -Dsonar.projectKey=${DRONE_REPO_OWNER}:${DRONE_REPO_NAME}
    -Dsonar.projectName=${DRONE_REPO_OWNER}:${DRONE_REPO_NAME}
    -Dsonar.projectVersion=${DRONE_TAG}
    -Dsonar.projectBaseDir=.
    -Dsonar.sourceEncoding=UTF-8
```
