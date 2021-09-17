GU Market
===========

Aplicação web desenvolvida em php para a disciplina de programação para internet, aplicação se trata de um e-commerce sem uma area de venda especifica, como o mercado livre por exemplo, o usuario pode ser criado, logado, realizar operações do tipo CRUD com fornecedores, produtos e carrinho.


Quick start
-----------

No Linux
-----------

1. Instale o xampp: ``https://www.edivaldobrito.com.br/como-instalar-o-xampp-no-linux/``

2. Inicie o Apache e Mysql, digite no terminal: ``cd // && sudo opt/lampp/xampp start``

3. Instale o git se necessário , digite no terminal: ``sudo apt install git``

4. Clone o projeto para dentro da pasta htdocs do xampp, digite no terminal : ``cd // && cd opt/lampp/htdocs && git clone 'https://github.com/ulissesg/GU_market.git'``

5. Caso prefira faça o download dos arquivos e coleque manualmente na pasta htdocs do xampp

6. Acesse o MyPhpAdmin, no navegador digite: ``http://localhost/phpmyadmin/``

7. Crie um novo banco de dados chamado: ``gu_market``

8. Acesse o BD e clique na aba importar, na pagina que será carregada clique em selecionar arquivo e então selecione o arquivo (o arquivo esta dentro da pasta GU_market clonada do repositório) e inicie a importação : ``gu_market.sql``

9. O projeto já deve estar funcionando, para acessa-lo digite no navegador: ``http://localhost/gu_market/``

10. Para testar os arquivos de conexão com o BD, digite no terminal (se o teste for interrompido por algum motivo, limpe todos os dados que o teste inseriu no BD, caso contrário o teste irá falhar): ``cd // && cd opt/lampp/htdocs/GU_market && ./test.sh``

11. Para testar a interface instale o selenium no seu navagador

12. Inicie o selenium e escolha a opção de abrir um projeto existente, e selecione o arquivo (o arquivo esta dentro da pasta GU_market clonada do repositório): ``gu_market.side``

13. Inicie o teste do selenium. (se o teste for interrompido por algum motivo, limpe todos os dados que o teste inseriu no BD, caso contrário o teste irá falhar)

No Windows
-----------

1. Instale o xampp

2. Inicie o Apache e Mysql

3. Instale o git se necessário, e abra o git cmd.

4. Clone o projeto para dentro da pasta htdocs do xampp, no terminal do git abra a pasta htdocs do xampp que se encontra em "C:\xampp\htdocs" e digite: ``git clone 'https://github.com/ulissesg/GU_market.git'``

5. Caso prefira faça o download dos arquivos e coleque manualmente na pasta htdocs do xampp

6. Acesse o MyPhpAdmin, no navegador digite: ``http://localhost/phpmyadmin/``

7. Crie um novo banco de dados chamado: ``gu_market``

8. Acesse o BD e clique na aba importar, na pagina que será carregada clique em selecionar arquivo e então selecione o arquivo (o arquivo esta dentro da pasta GU_market clonada do repositório) e inicie a importação : ``gu_market.sql``

9. O projeto já deve estar funcionando, para acessa-lo digite no navegador: ``http://localhost/gu_market/``

10. Para testar os arquivos de conexão com o BD, abra o arquivo(o arquivo esta dentro da pasta GU_market clonada do repositório), (se o teste for interrompido por algum motivo, limpe todos os dados que o teste inseriu no BD, caso contrário o teste irá falhar): ``test.cmd``

11. Para testar a interface instale o selenium no seu navagador

12. Inicie o selenium e escolha a opção de abrir um projeto existente, e selecione o arquivo (o arquivo esta dentro da pasta GU_market clonada do repositório): ``gu_market.side``

13. Inicie o teste do selenium. (se o teste for interrompido por algum motivo, limpe todos os dados que o teste inseriu no BD, caso contrário o teste irá falhar)