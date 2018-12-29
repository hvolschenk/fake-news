FROM node:dubnium-alpine

RUN apk update && apk add curl g++ make python && rm -rf /var/cache/apk/*

ENV CHOKIDAR_USEPOLLING true
ENV HOME /home/node/app

WORKDIR $HOME

VOLUME [$HOME]

RUN chown -Rv node:node $HOME
USER node
