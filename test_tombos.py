from selenium import webdriver
from pyvirtualdisplay import Display
import os
import time
# time.sleep(3.0)


display = Display(visible=1, size=(1800,900))
display.start()

total = 1
correct = 0

# Login na seção
driver = webdriver.Firefox(executable_path=os.getcwd() + "/geckodriver")
driver.get('http://localhost:8000')
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
report.click()
driver.forward()

# Test 1 - Open the tombos page
try:
    tombos_page = driver.find_element_by_xpath('//*[@id="container"]/div[2]/div/div/ul/li[2]/a')
    tombos_page.click()
    driver.forward()
    tombos_title = driver.find_element_by_tag_name('h1')

    if (tombos_title.text == 'Tombos'):
        correct += 1
        print("Teste de página de tombos concluído com sucesso")

except Exception as ex:
	print("ERRO no teste de página de tombos: " + str(ex))

driver.quit()
display.stop()

print("Testes tombos: "+str(correct)+" de "+str(total)+ " realizados com sucesso")
