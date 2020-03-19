#!/usr/bin/env bash
SSH_HOST="$1"

docker-compose up -d

docker cp ~/.ssh adminer_adminer-web_1:/root/.ssh
docker exec -it adminer_adminer-web_1 bash -c "chmod 700 /root/.ssh/  && chmod 600 /root/.ssh/config && chown -R root.root /root/.ssh/"

if ! [ -z $SSH_HOST ]

    then docker exec -it adminer_adminer-web_1 bash -c "ssh $SSH_HOST"
fi
