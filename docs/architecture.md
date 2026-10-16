# Architecture

```text
Browser
  |
  v
public entry point -> custom router -> controller -> view/template
                                      |
                                      +--> model/PDO -> MySQL

Docker Compose: PHP/Apache + MySQL + phpMyAdmin (local)
```

Vue is used as a lightweight template-side enhancement, not as a separately built SPA. The application currently exposes the home route only. The Docker topology is local development material and includes configuration that must not be reused outside controlled local work.
