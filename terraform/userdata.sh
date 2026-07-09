#!/bin/bash
set -euxo pipefail

# Log everything
exec > >(tee /var/log/userdata.log) 2>&1

echo "===================================="
echo "Starting EC2 initialization..."
echo "===================================="

apt-get update -y

apt-get install -y \
    docker.io \
    docker-compose-v2 \
    git \
    curl

systemctl enable docker
systemctl start docker

usermod -aG docker ubuntu

mkdir -p /opt/wordpress-devops

echo "Initialization completed successfully."