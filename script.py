# -*- coding: utf-8 -*-
from bs4 import BeautifulSoup
from urllib2 import urlopen
import urllib
import MySQLdb

db=MySQLdb.connect(
	host='localhost',
	user='root',
	passwd='17021942',
	db='textil',
	charset='utf8'

)

cur=db.cursor()

 
html_doc = urlopen('http://texdesign-shop.ru/catalog/postelnoe_bele/na_rezinke_1/?elems=48').read()
soup = BeautifulSoup(html_doc)
items_list=list()
img_list=list()
desc_list=list()
i=747;
#print soup
items = soup.find_all('div','element-container')
for item in items:
	i=i+1;
	name=item.find('div','element-name')
	print (name.text)
	image=item.find('img').get('src')
	print (image)
	price=item.find('div','new-cena', text=False)
	print (str(price)[36:41])
	size=item.find('ul','element-size')
	print(size.find('li').text[9:])
	resource = urllib.urlopen("http://texdesign-shop.ru"+image)
	pos=item.find('img').get('src').find('.')
	pos1=item.find('img').get('src').rfind('/')
	img="images"+image[pos1:pos]+".jpg"
	out = open(img, 'wb')
	out.write(resource.read())
	out.close()
	cur.execute('INSERT INTO items VALUES (id,%s,%s,%s,%s,%s)',[name.text,img,'0','','6'])
	db.commit()
	cur.execute('INSERT INTO Sizes VALUES (%s,%s,%s)',[i,size.find('li').text[9:],str(price)[36:41]])
	db.commit()
	


#print items
cur.close()
db.close()