from selenium import webdriver


# This is the first test to be run

driver = webdriver.Firefox()
# driver = webdriver.Remote(
#    command_executor='http://127.0.0.1:4444/wd/hub',
#    desired_capabilities=DesiredCapabilities.CHROME)
   
driver.get('http://localhost:8000')
element = driver.find_element_by_xpath("/html/body/div/div[4]/div[2]/div/div/div/div/a[2]/div")
element.click()
name = driver.find_element_by_xpath('//*[@id="login"]')
name.send_keys("rockrick")
password = driver.find_element_by_xpath('//*[@id="password"]')
password.send_keys("potato")
login = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/form/p[3]/input')
login.click()
report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
assert report is not None
print("Uau, vc é um admin")