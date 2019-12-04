from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import time
import sys

def test1(host):
    ### Test 1 - Test if the user can log in as an admin ###
    global passes
    result = False

    driver = webdriver.Firefox()
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

    try:
        print("ENTREI NO TRY")
        report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
        print("PASSEI PELA LINHA")
    except:
        print("ENTREI NO EXCEPT")
        report = None
    
    if report is not None: #The report button should only appear when the user is an admin 
        result = True
        passes += 1
    return result

def test2(host):
    ### Test 2 - Test if the user can log in while not being an admin an cannot access admin pages ###
    global passes
    result = False

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
        result = True
        passes += 1
    return result

## If you add more tests, change this number
total = 2
passes = 0

flag = ''
if len(sys.argv) > 1:
    flag = str(sys.argv[1])
host  = 'http://localhost:8000/'
if flag == '-dk':
    host  = 'http://localhost:8009/'

print("Starting admin tests...")
if not test1(host):
    print("Test 1 failed!")
if not test2(host):
    print("Test 2 failed!")
print("%i/%i tests passed" % (passes, total))

