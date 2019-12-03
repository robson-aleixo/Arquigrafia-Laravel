from selenium import webdriver
from pyvirtualdisplay import Display
import os

display = Display(visible=1)
display.start()

driver = webdriver.Firefox(executable_path=os.getcwd() + "/geckodriver")
driver.get('http://localhost:8009')
element = driver.find_element_by_xpath("/html/body/div/div[4]/div[2]/div/div/div/div/a[2]/div")
assert element is not None
# element.click()
# name = driver.find_element_by_xpath('//*[@id="login"]')
# name.send_keys("robson")
# password = driver.find_element_by_xpath('//*[@id="password"]')
# password.send_keys("123456")
# login = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/form/p[3]/input')
# login.click()
# report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
# assert report is not None
print("Uau, vc é um admin")