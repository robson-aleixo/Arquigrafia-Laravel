from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from pyvirtualdisplay import Display
import sys
import os

flag = ''
if len(sys.argv) > 1:
    flag = str(sys.argv[1])
host  = 'http://localhost:8000/'
if flag == '-dk':
    host  = 'http://localhost:8009/'

display = Display(visible=1, size=(1800,900))
display.start()

driver = webdriver.Firefox(executable_path=os.getcwd() + "/geckodriver")
driver.get(host)
signup_button = driver.find_element_by_class_name("cadastro-inicio")
signup_button.click()
name = driver.find_element_by_id("name")
name.send_keys("teste1")
login = driver.find_element_by_id("login")
login.send_keys("teste1")
email = driver.find_element_by_id("email")
email.send_keys("teste1@test.com")
password = driver.find_element_by_id("password")
password.send_keys("teste1")
confirm = driver.find_element_by_id("password_confirmation")
confirm.send_keys("teste1")
check = driver.find_element_by_name('terms')
check.click()
password.send_keys(Keys.ENTER)

driver2 = webdriver.Firefox(executable_path=os.getcwd() + "/geckodriver")
driver2.get(host)
signup_button2 = driver2.find_element_by_class_name("cadastro-inicio")
signup_button2.click()
name2 = driver2.find_element_by_id("name")
name2.send_keys("teste2")
login2 = driver2.find_element_by_id("login")
login2.send_keys("teste2")
email2 = driver2.find_element_by_id("email")
email2.send_keys("teste2@test.com")
password2 = driver2.find_element_by_id("password")
password2.send_keys("teste2")
confirm2 = driver2.find_element_by_id("password_confirmation")
confirm2.send_keys("teste2")
check2 = driver2.find_element_by_name('terms')
check2.click()
password2.send_keys(Keys.ENTER)

driver.quit()
display.stop()