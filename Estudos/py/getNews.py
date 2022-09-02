

import os
import sys
import urllib.request
from bs4 import BeautifulSoup
import json
from datetime import date

today = date.today()
d = today.strftime("%d-%m-%Y")

soup = BeautifulSoup(urllib.request.urlopen("https://news.google.com/topics/CAAqJQgKIh9DQkFTRVFvSUwyMHZNREUxWm5JU0JYQjBMVUpTS0FBUAE?hl=pt-BR&gl=BR").read().decode('utf-8'), features="lxml")
html = open("recursos/json/news_"+d+".json", "w", encoding="utf-8") 
news = []
index = 0
html.write('{')
for link in soup.find_all('h3'):
    a = link.find('a')  
    txt = a.get_text()
    href = 'https://news.google.com/' + a.get('href')
    new = '"'+str(index)+'":{"texto":"'+txt+'","href":"'+href+'"}'
    if index != 0:
        new = ',' + new
    html.write(new)
    index+=1    

# news_json = json.dumps(news, ensure_ascii = False)    
# html.write(news_json)
html.write('}')
html.close() 