from selenium import webdriver

total = 5
correct = 0

driver = webdriver.Firefox()
driver.get('http://localhost:8000')
element = driver.find_element_by_xpath("/html/body/div/div[4]/div[2]/div/div/div/div/a[2]/div")
element.click()
driver.forward()
username = driver.find_element_by_xpath('//*[@id="login"]')
username.send_keys("local2")
password = driver.find_element_by_xpath('//*[@id="password"]')
password.send_keys("local2")
login = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/form/p[3]/input')
login.click()
driver.forward()
report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
report.click()
driver.forward()

reports_inst = driver.find_element_by_xpath("/html/body/div[1]/div[2]/div/div/ul/li[2]/a")
reports_inst.click()
driver.forward()
new_inst = driver.find_element_by_xpath("/html/body/div[1]/center/a")
new_inst.click()
driver.forward()
name = driver.find_element_by_xpath('/html/body/div[1]/div[2]/form/div/div[2]/div[3]/p[1]/input')
name.send_keys("Teste")
email = driver.find_element_by_xpath('//*[@id="email"]')
email = send_keys("testes@teste.com")
submit = driver.find_element_by_xpath("/html/body/div[1]/div[2]/form/div/div[2]/div[20]/input")
submit.click()
driver.forward()
last_inst = driver.find_element_by_xpath('/html/body/div[1]/center/table/tbody/tr[6]/td[1]/ul/a')
inst_name = last_inst.texts
if(inst_name == 'Teste'):
	correct += 1

report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
report.click()
driver.forward()
usr_inst = driver.find_element_by_xpath("/html/body/div[1]/div[2]/div/div/ul/li[4]/a")
usr_inst.click()
driver.forward()
new_link = driver.find_element_by_xpath("/html/body/div[1]/center/a")
new_link.click()
driver.forward()
name = driver.find_element_by_xpath('//*[@id="name"]')
name.send_keys("local2")
list_inst = driver.find_element_by_xpath("/html/body/div[1]/form/div[2]/select/option[text()='Teste']")
list_inst.click()
driver.forward()
submit = driver.find_element_by_xpath('/html/body/div[1]/form/input[2]')
submit.click()
driver.forward()
login = driver.find_element_by_xpath("/html/body/div[1]/center/table/tbody/tr[52]/td[1]/ul")
login_text = login.text
inst = driver.find_element_by_xpath("/html/body/div[1]/center/table/tbody/tr[53]/td[2]/ul")
inst_text = inst.text
if(login_text = "local2" and inst_text = "Teste"):
	correct += 1

report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
report.click()
driver.forward()
reports_inst = driver.find_element_by_xpath("/html/body/div[1]/div[2]/div/div/ul/li[2]/a")
reports_inst.click()
driver.forward()
excluir = driver.find_element_by_xpath('/html/body/div[1]/center/table/tbody/tr[6]/td[3]/form/input[3]')
excluir.click()
driver.forward()
last_inst = driver.find_element_by_xpath('/html/body/div[1]/center/table/tbody/tr[6]/td[1]/ul/a')
inst_name = last_inst.texts
if(inst_name == 'Teste'):
	correct += 1

eport = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
report.click()
driver.forward()
report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
report.click()
driver.forward()
usr_inst = driver.find_element_by_xpath("/html/body/div[1]/div[2]/div/div/ul/li[4]/a")
usr_inst.click()
driver.forward()
excluir = driver.find_element_by_xpath("/html/body/div[1]/center/table/tbody/tr[52]/td[4]/form/input[3]")
excluir.click()
driver.forward()
try:
	inexistet = driver.find_element_by_xpath("/html/body/div[1]/center/table/tbody/tr[52]/td[1]/ul")
	inex = inexistet.text
except:
	correct += 1


report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
report.click()
driver.forward()
reports_inst = driver.find_element_by_xpath("/html/body/div[1]/div[2]/div/div/ul/li[2]/a")
reports_inst.click()
driver.forward()
excluir = driver.find_element_by_xpath('/html/body/div[1]/center/table/tbody/tr[6]/td[3]/form/input[3]')
excluir.click()
driver.forward()
try:
	inexistet = driver.find_element_by_xpath('/html/body/div[1]/center/table/tbody/tr[6]/td[1]/ul/a')
	inex = inexistet.texts
except:
	correct += 1

print(str(correct)+"/"+str(total)+ "testes realizados com sucesso")


