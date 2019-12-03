from selenium import webdriver

total = 4
correct = 0

driver = webdriver.Firefox()
driver.get('http://localhost:8000')
element = driver.find_element_by_xpath("/html/body/div/div[4]/div[2]/div/div/div/div/a[2]/div")
element.click()
drive.forward()
username = driver.find_element_by_xpath('//*[@id="login"]')
username.send_keys("local2")
password = driver.find_element_by_xpath('//*[@id="password"]')
password.send_keys("local2")
login = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/form/p[3]/input')
login.click()
drive.forward()
report = driver.find_element_by_xpath('/html/body/div[1]/div[1]/div/div[3]/ul/li[6]/a')
report.click()
drive.forward()

report_tags = driver.find_element_by_xpath("/html/body/div[1]/div[2]/div/div/ul/li[1]/a")
report_tags.click()
drive.forward()
new_tag = driver.find_element_by_xpath("/html/body/div[1]/a")
new_tag.click()
drive.forward()
name = driver.find_element_by_xpath('//*[@id="name"]')
name.send_keys("aaa")
description = driver.find_element_by_xpath("/html/body/div[1]/form/div[2]/input")
description.send_keys("Tag sendo criada")
cat1 = driver.find_element_by_xpath('//*[@id="cat_1"]')
cat1.send_keys("Teste")
submit = driver.find_element_by_xpath("/html/body/div[1]/form/input[2]")
submit.click()
drive.forward()
fisrt_tag = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/div/table/tbody/tr[1]/td[1]/ul')
tag_name = fisrt_tag.getText()
if(tag_name == 'aaa'):
	correct += 1

edit_tag = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/div/table/tbody/tr[1]/td[3]/a')
edit_tag.click()
drive.forward()
name = driver.find_element_by_xpath('//*[@id="name"]')
name.send_keys("aaaa")
submit = driver.find_element_by_xpath("/html/body/div[1]/form/input[2]")
submit.click()
drive.forward()
fisrt_tag = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/div/table/tbody/tr[1]/td[1]/ul')
tag_name = fisrt_tag.getText()
if(tag_name == 'aaaa'):
	correct += 1

new_tag = driver.find_element_by_xpath("/html/body/div[1]/a")
new_tag.click()
drive.forward()
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
drive.forward()
secound_tag = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/div/table/tbody/tr[2]/td[2]')
equiv_tag = secound_tag.text
if(equiv_tag == 'Equivale a aaaa'):
	correct += 1

excluir = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/div/table/tbody/tr[1]/td[4]/form/input[3]')
excluir.click()
drive.forward()
fisrt_tag = driver.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/div/table/tbody/tr[1]/td[1]/ul')
tag_name = fisrt_tag.getText()
if(tag_name != 'aaaa' and tag_name != 'aaa' and tag_name != 'aab'):
	correct += 1

print(str(correct)+"/"+str(total)+ "testes realizados com sucesso")


