FROM centos:6

MAINTAINER @piccagliani

RUN cp -p /usr/share/zoneinfo/Asia/Tokyo /etc/localtime
RUN echo ZONE="Asia/Tokyo" > /etc/sysconfig/clock
RUN echo UTC="false" >> /etc/sysconfig/clock
RUN source /etc/sysconfig/clock

RUN yum update -y
RUN rpm -Uvh http://ftp.jaist.ac.jp/pub/Linux/Fedora/epel/6/i386/epel-release-6-8.noarch.rpm
RUN rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-6.rpm
RUN yum install -y --enablerepo=remi --enablerepo=remi-php56 php php-mbstring php-mcrypt
RUN rpm -Uvh http://dev.mysql.com/get/mysql-community-release-el6-5.noarch.rpm
RUN yum install -y mysql-community-server
ADD my.cnf /etc/my.cnf 

RUN yum install -y --enablerepo=remi --enablerepo=remi-php56 php php-pdo php-mysql php-mbstring php-mcrypt

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

ADD env /opt/ci-test/.env

CMD ["/bin/bash"]