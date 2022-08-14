# toumlilt.com

My personal website,
hosted at ([https://toumlilt.com](https://toumlilt.com))

## Build & Deploy

The website is static, you only need an Apache/Nginx server + PHP, and copy files to your servers target dir.

A `Makefile` is provided to help copy the static files to `dist` folder without noise, and without writing the server specific `config.php` file.

Use `make build` to build both prod and dev versions.
And `make clean` to remove all dist files except config.

### CI/CD Configuration

CI/CD is done through Github Actions,
check [.github/workflows/ci.yml](./.github/workflows/ci.yml)
and [.github/workflows/cd.yml](./.github/workflows/cd.yml)
for the build and deploy through SSH process.

CI is executed at each push, and CD is processed at each push to master.

In order to use SSH for deployement, you need to set some repository secret environment variables.
Under this repository -> Settings -> Secrets -> Actions -> New Repository Secret

- `SSH_PRIVATE_KEY`

Private key part of an SSH key pair. The public key part should be added to the `authorized_keys` file on the server that receives the deployment.

More info for SSH keys: [https://www.ssh.com/ssh/public-key-authentication](https://www.ssh.com/ssh/public-key-authentication)

The keys should be generated using the PEM format. You can use this command

```bash
ssh-keygen -m PEM -t rsa -b 4096
```

- `REMOTE_HOST`

eg: toumlilt.com

- `REMOTE_USER`

eg: mydeployusername

- `REMOTE_PORT`

eg: 22

- `REMOTE_TARGET`

eg: `/var/www/html/`

### Server configuration

Please find nginx and apache config examples in the [config](./config) folder.

You also need to set up `config.php` env variables (under `./src` but also `./dist`) to match your servers URI and files path.

Note: default htaccess config requires SSL, or disable the http->https rewriteRule.

## Author

- Original Design template : Xiaoying Riley at 3rd Wave Media Ltd. [original template link](http://themes.3rdwavemedia.com/)
- Improved by : Ilyas Toumlilt ([www.toumlilt.com](www.toumlilt.com))

## License

This template is free under the Creative Commons Attribution 3.0 [License](https://creativecommons.org/licenses/by/3.0/).

## Versions

- v1.3.3 (stable)(current)
- v1.3.2
- v1.3.1
- v1.2.3
- v1.2.2
- v1.2.1 (stable php7.1)
- v1.2
- v1.1
- v1.0.1
- v1.0
