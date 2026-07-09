FROM jenkins/jenkins:lts-jdk21

USER root

RUN apt-get update && \
    apt-get install -y \
    curl \
    git \
    unzip \
    docker.io

USER jenkins