from selenium import webdriver
from pyvirtualdisplay import Display
import os
import time
# time.sleep(3.0)


display = Display(visible=1, size=(1800,900))
display.start()

total = 4
correct = 0

# Login na seção
driver = webdriver.Firefox(executable_path=os.getcwd() + "/geckodriver")
driver.get('http://localhost:8009')
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

# Test 1
try:
	report_tags = driver.find_element_by_xpath("/html/body/div[1]/div[2]/div/div/ul/li[1]/a")
	report_tags.click()
	driver.forward()
	new_tag = driver.find_element_by_xpath("/html/body/div[1]/a")
	new_tag.click()
	driver.forward()
	name = driver.find_element_by_xpath('//*[@id="name"]')
	name.send_keys("aaa")
	description = driver.find_element_by_xpath("/html/body/div[1]/form/div[2]/input")
	description.send_keys("Tag sendo criada")
	cat1 = driver.find_element_by_xpath('//*[@id="cat_1"]')
	cat1.send_keys("Teste")
	submit = driver.find_element_by_xpath("/html/body/div[1]/form/input[2]")
	submit.click()
	fisrt_tag = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/div/table/tbody/tr[1]/td[1]/ul')
	tag_value = fisrt_tag.text
	if(tag_value == 'aaa'):
		correct += 1
		print("Teste de escrita de tag concluído com sucesso")
except Exception as ex:
	print("ERRO no teste de escrita de tag: " + str(ex))


# Teste 2
try: 
	edit_tag = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/div/table/tbody/tr[1]/td[3]/a')
	edit_tag.click()
	name = driver.find_element_by_xpath('//*[@id="name"]')
	name.clear()
	name.send_keys("aaaa")
	submit = driver.find_element_by_xpath("/html/body/div[1]/form/input[2]")
	submit.submit()
	driver.get('http://localhost:8000/tags')
	fisrt_tag = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/div/table/tbody/tr[1]/td[1]/ul')
	tag_value = fisrt_tag.text
	if(tag_value == 'aaaa'):
		correct += 1
		print("Teste de edição de tag concluído com sucesso")
except Exception as ex:
	print("ERRO no teste de edição de tag"+ str(ex))

# Teste 3
try:
	new_tag = driver.find_element_by_xpath("/html/body/div[1]/a")
	new_tag.click()
	time.sleep(1.0)
	driver.forward()
	name = driver.find_element_by_xpath('//*[@id="name"]')
	name.send_keys("aab")
	description = driver.find_element_by_xpath("/html/body/div[1]/form/div[2]/input")
	description.send_keys("Tag sendo linkada")
	equiv = driver.find_element_by_xpath('/html/body/div[1]/form/div[3]/input')
	equiv.send_keys("aaaa")
	cat1 = driver.find_element_by_xpath('//*[@id="cat_1"]')
	cat1.send_keys("Teste")
	submit = driver.find_element_by_xpath("/html/body/div[1]/form/input[2]")
	submit.click()
	driver.forward()
	secound_tag = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/div/table/tbody/tr[2]/td[2]')
	equiv_tag = secound_tag.text
	if(equiv_tag == 'Equivale a aaaa'):
		correct += 1
		print("Teste equivalência de tag concluído com sucesso") 
except Exception as ex:
	print("ERRO no teste de equivalência de tag"+ str(ex))

# Teste 4
try:
	driver.get('http://localhost:8000/tags')
	excluir = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/div/table/tbody/tr[1]/td[4]/form/input[3]')
	excluir.click()
	driver.forward()
	fisrt_tag = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/div/table/tbody/tr[1]/td[1]/ul')
	tag_excl = fisrt_tag.text
	if(fisrt_tag != 'aaaa' and fisrt_tag != 'aaa' and fisrt_tag != 'aab'):
		correct += 1
		print("Teste de exclusão de tag concluído com sucesso")
except Exception as ex:
	print("ERRO no teste de exclusão de tag"+ str(ex))

driver.quit()
display.stop()

print("Testes tag: "+str(correct)+" de "+str(total)+ " realizados com sucesso")


