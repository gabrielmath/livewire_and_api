Parar rodar o composer via docker:

```bash
docker run --rm --interactive --tty \
--volume $PWD:/app \
--user $(id -u):$(id -g) \
composer install
```

Para rodar o projeto via Sail:

```bash
./vendor/bin/sail up -d
```

Para facilitar o uso do comando, recomendo criar um `alias` para o mesmo:

```bash
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```

Após, execute o comando da seguinte forma:

```bash
sail up -d
```

## Lembrete

Para qualquer pacote do composer ou npm, rodar:

`sail composer <command>` ou `sail npm <command>`
