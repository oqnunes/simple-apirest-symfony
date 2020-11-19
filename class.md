



Rotas

> As rotas podem ser

  > Separada

    - É necessário alterar apenas o arquivo 'routes.yaml'.

  > No próprio arquivo.  

    - No início de cada Controller deve-se retornar dessa forma.

      /**
      * @RouteName()
      */

Views

  > Twig

    > Configuracões 

      - Dentro das pastas templates deverá conter o nome de cada arquivo example.

        index.html.twig

      - Esses arquivos são interpretados pelo pluggin do Twig.

    > Importando outras variaveis de outras paginas.

      - Utilizar o metodo extends e chamar o nome do arquivo
