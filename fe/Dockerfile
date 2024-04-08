# DEV STAGE
FROM node:20-alpine3.19 as dev-stage
WORKDIR /app
ENV PATH /app/node_modules/.bin:$PATH
COPY package*.json ./
RUN yarn install
COPY . .

# BUILD STAGE
# FROM dev-stage as build-stage
# RUN yarn build

EXPOSE 3000
