#!/usr/bin/python
# -*- coding: utf-8 -*-

import ESL
import sys

host = '127.0.0.1'
port = '8021'
password = 'ClueCon'
dest = sys.argv[1]
msg = sys.argv[2]
con = ESL.ESLconnection(host, port, password)
if con.connected:
	event = ESL.ESLevent("SEND_MESSAGE")
	event.addHeader("command", "sendevent SEND_MESSAGE")
	event.addHeader("profile", "internal")
	event.addHeader("content-type", "text/plain")
	event.addHeader("user", dest)
	event.addHeader("host", "192.168.43.175")
	event.addBody(msg)
	e = con.sendEvent(event)
	print e.getBody()
	print e.serialize()




