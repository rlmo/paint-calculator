FROM node:alpine

COPY ./ /home/node/app

WORKDIR /home/node/app

CMD npm i; \
    npm i -g vite; \
    npm i -g postcss-nesting; \
    vite;

EXPOSE 9000