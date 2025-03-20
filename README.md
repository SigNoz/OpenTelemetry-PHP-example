# OpenTelemetry-PHP-example


## Step 1: Setup Development Environment

To configure our PHP application to send data, you need to use the OpenTelemetry PHP extension. Since the extension is built from the source, you need to have the build tools, which can be installed using the following command:

### Linux (apt)
```sh
sudo apt install gcc make autoconf
```

### Mac (Homebrew)
```sh
brew install gcc make autoconf
```

## Step 2: Build the Extension

With our environment set up, we can install the extension using PECL:

```sh
pecl install opentelemetry               
pecl install protobuf
```

After successfully installing the OpenTelemetry extension, add the extension to the `php.ini` file of your project:

```ini
[opentelemetry]
extension=opentelemetry.so
```

Verify that the extension is enabled by running:

```sh
php -m | grep opentelemetry
```

This should output:

```
opentelemetry
```

## Step 3: Add the Dependencies

Add dependencies required for OpenTelemetry SDK for PHP to perform automatic instrumentation using this command:

```sh
composer config allow-plugins.php-http/discovery false
composer require \
  open-telemetry/sdk \
  open-telemetry/exporter-otlp \
  php-http/guzzle7-adapter \
  open-telemetry/opentelemetry-auto-slim
```

✅ **Info:**
You can install the additional dependencies provided by OpenTelemetry for different PHP frameworks from [here](https://opentelemetry.io/docs/instrumentation/php/).

## Step 4: Set Environment Variables and Run the App

We are passing the environment variables at runtime, so we don't have to change anything in the code. Run your application using:

```sh
env OTEL_PHP_AUTOLOAD_ENABLED=true \
    OTEL_SERVICE_NAME=<SERVICE_NAME> \
    OTEL_TRACES_EXPORTER=otlp \
    OTEL_EXPORTER_OTLP_PROTOCOL=http/protobuf \
    OTEL_EXPORTER_OTLP_ENDPOINT=ingest.<region>.signoz.cloud:443 \
    OTEL_EXPORTER_OTLP_HEADERS=signoz-ingestion-key=<INGESTION_KEY> \
    OTEL_PROPAGATORS=baggage,tracecontext \
    php -S localhost:8080 app.php
```

- Replace `<region>` with your SigNoz Cloud region.
- Replace `<INGESTION_KEY>` with your SigNoz ingestion key.
- Replace `<SERVICE_NAME>` with the name of your service.

