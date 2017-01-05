#!/usr/bin/env python
# -*- coding: utf-8 -*-

from ESL import *
import sys
#import mysql.connector 

Host = "127.0.0.1"
Port = "8021"
Password = "ClueCon"

con = ESLconnection(Host, Port, Password)

#conn = mysql.connector.connect(host="localhost",user="root",password="passer", database="xivo")
#cursor = conn.cursor()


if con.connected():
	cmd = "originate user/"+sys.argv[1]+" 5000"
	rep = con.api(cmd)
	#rep = con.execute("chat" "sip|1002@192.168.43.175|1006@192.168.43.175|Hello test")
	corps = rep.getBody()
#	res = corps[0:3]
#	if(res!='+OK'):
#		donne = {"name": "olivier", "age" : "34"}
		
#		cursor.execute("""UPDATE Appel SET IdAppel=[value-1],`destinataire`=[value-2],`nomCampagne`=[value-3],`dateCampagne`=[value-4],`heureCampagne`=[value-5],`message`=[value-6] WHERE 1     UPDATE INTO users (name, age) VALUES(%(name)s, %(age)s)""", user)
#		conn.close()
else:
	print "non connecté"
