from selenium import webdriver
import time
import sys

def test1(host):
    ### Test 1 - Test if the user can log in as an admin ###
    global passes
    result = False
    driver = webdriver.Firefox()
    driver.get(host)
    login_button = driver.find_element_by_xpath("/html/body/div/div[4]/div[2]/div/div/div/div/a[2]/div")
    login_button.click()
    name = driver.find_element_by_xpath('//*[@id="login"]')
    name.send_keys("local2")
    password = driver.find_element_by_xpath('//*[@id="password"]')
    password.send_keys("local2")
    login = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/form/p[3]/input')
    login.click()
    report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
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
    login_button = driver.find_element_by_xpath("/html/body/div/div[4]/div[2]/div/div/div/div/a[2]/div")
    login_button.click()
    name = driver.find_element_by_xpath('//*[@id="login"]')
    name.send_keys("local2")
    password = driver.find_element_by_xpath('//*[@id="password"]')
    password.send_keys("local2")
    login = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/form/p[3]/input')
    login.click()
    report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')

    driver.get(host + 'adm-reports')
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

