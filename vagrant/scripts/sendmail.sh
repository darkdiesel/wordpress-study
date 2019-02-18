#!/usr/bin/env bash

echo "Install SendMail"
sudo apt-get install -q -y sendmail sendmail-bin sasl2-bin > /dev/null 2>&1

echo "SendMail Config"
sudo sendmailconfig -y