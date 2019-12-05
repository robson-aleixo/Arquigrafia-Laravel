from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from pyvirtualdisplay import Display
import time
import sys
import os

display = Display(visible=1, size=(1800,900))
display.start()

## If you add more tests, change this number
total = 2
passes = 0

flag = ''
if len(sys.argv) > 1:
    flag = str(sys.argv[1])
host  = 'http://localhost:8000/'
if flag == '-dk':
    host  = 'http://localhost:8009/'


### Test 1 - Test if the user can log in as an admin ###
try:
    driver = webdriver.Firefox(executable_path=os.getcwd() + "/geckodriver")
    driver.get(host)
    element = driver.find_element_by_xpath("/html/body/div/div[4]/div[2]/div/div/div/div/a[2]/div")
    element.click()
    driver.forward()
    username = driver.find_element_by_xpath('//*[@id="login"]')
    username.send_keys("teste1")
    password = driver.find_element_by_xpath('//*[@id="password"]')
    password.send_keys("teste1")
    login = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/form/p[3]/input')
    login.click()
    driver.forward()
    report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')

    
    if report is not None: #The report button should only appear when the user is an admin 
        passes += 1
        print("Teste de login como admin concluído com sucesso")

except Exception as ex:
	print("ERRO no teste de login como admin: " + str(ex))


### Test 2 - Test if the user can log in while not being an admin and cannot access admin pages ###
try:
    driver = webdriver.Firefox(executable_path=os.getcwd() + "/geckodriver")
    driver.get(host)
    element = driver.find_element_by_xpath("/html/body/div/div[4]/div[2]/div/div/div/div/a[2]/div")
    element.click()
    driver.forward()
    username = driver.find_element_by_xpath('//*[@id="login"]')
    username.send_keys("teste2")
    password = driver.find_element_by_xpath('//*[@id="password"]')
    password.send_keys("teste2")
    login = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/form/p[3]/input')
    login.click()
    driver.forward()
    try:
        report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
    except:
        report = None
    
    driver.get(host + 'adm-reports')
    driver.forward()
    time.sleep(.5)
    url = driver.current_url

    #The report button should only appear when the user is an admin and they should have been redirected 
    if (report is None) and (url == (host + 'home')):
        passes += 1
        print("Teste de login como não-admin concluído com sucesso")

except Exception as ex:
	print("ERRO no teste de login não-admin: " + str(ex))

driver.quit()
display.stop()

print("Testes admin: "+str(passes)+" de "+str(total)+ " realizados com sucesso")

