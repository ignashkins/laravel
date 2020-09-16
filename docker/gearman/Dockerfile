FROM ubuntu:18.04

ENV DEBIAN_FRONTEND noninteractive

RUN \
  apt-get update -y && \
  apt-get install -y apt-utils 2>&1 | grep -v "debconf: delaying package configuration, since apt-utils is not installed" && \
  apt-get install -y gearman-job-server

ENTRYPOINT [ "gearmand" ]
