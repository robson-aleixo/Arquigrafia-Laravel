from selenium import webdriver
from pyvirtualdisplay import Display
import os
import time

display = Display(visible=1, size=(1800,900))
display.start()

total = 5
correct = 0

# Acessar a página de reports
driver = webdriver.Firefox()
driver.get('http://localhost:8000')
element = driver.find_element_by_xpath("/html/body/div/div[4]/div[2]/div/div/div/div/a[2]/div")
element.click()
driver.forward()
username = driver.find_element_by_xpath('//*[@id="login"]')
username.clear()
username.send_keys("teste1")
password = driver.find_element_by_xpath('//*[@id="password"]')
password.clear()
password.send_keys("teste1")
login = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/form/p[3]/input')
login.click()
driver.forward()
report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
report.click()
driver.forward()

# Teste 1
try:
	reports_inst = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div/ul/li[3]/a')
	reports_inst.click()
	driver.forward()
	new_inst = driver.find_element_by_xpath("/html/body/div[1]/center/a")
	new_inst.click()
	driver.forward()
	name = driver.find_element_by_xpath('/html/body/div[1]/div[2]/form/div/div[2]/div[3]/p[1]/input')
	name.send_keys("Teste")
	email = driver.find_element_by_xpath('//*[@id="email"]')
	email.clear()
	email.send_keys("testes@teste.com")
	submit = driver.find_element_by_xpath("/html/body/div[1]/div[2]/form/div/div[2]/div[20]/input")
	submit.click()
	driver.forward()
	last_inst = driver.find_element_by_xpath('/html/body/div[1]/center/table/tbody/tr[2]/td[1]/ul/a')
	inst_name = last_inst.text
	if (inst_name == 'Teste'):
		correct += 1
	else:
		raise Exception("O nome da instituição deveria ser Teste mas foi  "  + inst_name)
except Exception as ex:
	print("ERRO no teste de criação de instituição: " + str(ex))


try:
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
	name.send_keys("teste1")
	list_inst = driver.find_element_by_xpath("/html/body/div[1]/form/div[2]/select/option[text()='Teste']")
	list_inst.click()
	driver.forward()
	submit = driver.find_element_by_xpath('/html/body/div[1]/form/input[2]')
	submit.click()
	driver.forward()
	login = driver.find_element_by_xpath("/html/body/div[1]/center/table/tbody/tr[2]/td[1]/ul")
	login_text = login.text
	inst = driver.find_element_by_xpath("/html/body/div[1]/center/table/tbody/tr[2]/td[2]/ul")
	inst_text = inst.text
	if (login_text == "teste1" and inst_text == "Teste"):
		correct += 1
	else:
		raise Exception("O nome do empregado e da instituição deveriam ser teste1 e Teste mas foram  "  + login_text + " e " + inst_text)
except Exception as ex:
	print("ERRO no teste de criação de empregado: " + str(ex))

try:
	report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
	report.click()
	driver.forward()
	reports_inst = driver.find_element_by_xpath("/html/body/div[1]/div[2]/div/div/ul/li[3]/a")
	reports_inst.click()
	driver.forward()
	excluir = driver.find_element_by_xpath('/html/body/div[1]/center/table/tbody/tr[2]/td[3]/form/input[3]')
	excluir.click()
	driver.forward()
	last_inst = driver.find_element_by_xpath('/html/body/div[1]/center/table/tbody/tr[2]/td[1]/ul/a')
	inst_name = last_inst.text
	if(inst_name == 'Teste'):
		correct += 1
	else:
		raise Exception("O nome da instituição deveria ser Teste mas foi  "  + inst_name)
except Exception as ex:
	print("ERRO no teste de falhar em excluir instituição: " + str(ex))

try:
	report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
	report.click()
	driver.forward()
	report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
	report.click()
	driver.forward()
	usr_inst = driver.find_element_by_xpath("/html/body/div[1]/div[2]/div/div/ul/li[4]/a")
	usr_inst.click()
	driver.forward()
	excluir = driver.find_element_by_xpath("/html/body/div[1]/center/table/tbody/tr[2]/td[4]/form/input[3]")
	excluir.click()
	driver.forward()
	try:
		inexistet = driver.find_element_by_xpath("/html/body/div[1]/center/table/tbody/tr[2]/td[1]/ul")
		inex = inexistet.text
	except:
		correct += 1
	else:
		raise Exception("O empregado não foi excluído" )
except Exception as ex:
	print("ERRO no teste de excluir empregado: " + str(ex))


try:
	report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
	report.click()
	driver.forward()
	reports_inst = driver.find_element_by_xpath("/html/body/div[1]/div[2]/div/div/ul/li[3]/a")
	reports_inst.click()
	driver.forward()
	excluir = driver.find_element_by_xpath('/html/body/div[1]/center/table/tbody/tr[2]/td[3]/form/input[3]')
	excluir.click()
	driver.forward()
	try:
		inexistet = driver.find_element_by_xpath('/html/body/div[1]/center/table/tbody/tr[2]/td[1]/ul/a')
		inex = inexistet.text
	except:
		correct += 1
	else:
		raise Exception("A instituição não foi excluída" )
except Exception as ex:
	print("ERRO no teste de excluir instiruição: " + str(ex))


driver.quit()
display.stop()

print("Testes de instituições: "+str(correct)+" de "+str(total)+ " realizados com sucesso")


