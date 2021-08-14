FROM ubuntu:latest  
RUN apt-get update  
RUN apt-get install -y nginx  
COPY ./config/application.local.conf /etc/nginx/conf.d/application.local.conf
WORKDIR /data  
VOLUME /data  
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]