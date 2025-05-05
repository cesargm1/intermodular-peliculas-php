# Descripción de las Ramas

Este repositorio sigue un flujo de trabajo basado en Git Flow. A continuación, se describen las funciones de cada rama:

- **Main**: Contiene la versión estable y en producción del proyecto. Solo se realizan merges desde `release`.
- **develop**: Rama de desarrollo principal donde se integran nuevas funcionalidades antes de pasar a `release`.
- **feature1**: Rama temporal utilizada para desarrollar una nueva funcionalidad específica. Se fusionará en `develop` una vez completada.
- **feature2**: Similar a `feature1`, esta rama contiene otra funcionalidad en desarrollo antes de integrarse en `develop`.
- **release**: Rama utilizada para preparar la siguiente versión estable. Se generan correcciones finales antes de fusionarse en `main` y `develop`.
