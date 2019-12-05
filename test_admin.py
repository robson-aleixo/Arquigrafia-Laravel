from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import time
import sys
import os


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
    login_button = driver.find_element_by_class_name("login-inicio")
    login_button.click()
    driver.forward()
    name = driver.find_element_by_id('login')
    name.send_keys("teste1")
    password = driver.find_element_by_id('password')
    password.send_keys("teste1")
    password.send_keys(Keys.ENTER)
    driver.forward()
    report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
    
    if report is not None: #The report button should only appear when the user is an admin 
        passes += 1
        print("Teste de login como admin concluuído com sucesso")

except Exception as ex:
	print("ERRO no teste de login como admin: " + str(ex))


### Test 2 - Test if the user can log in while not being an admin and cannot access admin pages ###
try:
    driver = webdriver.Firefox()
    driver.get(host)
    login_button = driver.find_element_by_class_name("login-inicio")
    login_button.click()
    driver.forward()
    name = driver.find_element_by_id('login')
    name.send_keys("teste2")
    password = driver.find_element_by_id('password')
    password.send_keys("teste2")
    password.send_keys(Keys.ENTER)
    driver.forward()
    time.sleep(1)

    report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
    
    driver.get(host + 'adm-reports')
    driver.forward()
    time.sleep(.5)
    url = driver.current_url

    #The report button should only appear when the user is an admin and they should have been redirected 
    if (report is None) and (url == (host + 'home')):
        passes += 1
        print("Teste de login como não-admin concluuído com sucesso")

except Exception as ex:
	print("ERRO no teste de login não-admin: " + str(ex))


print("%i/%i tests passed" % (passes, total))

