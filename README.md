# HealthCheck for Neos

This package allows a simple health check for a Neos website.
It checks if the flow Framework is up and running and makes a database request to test the database connection.

The url to call is `/healthcheck` and will provide a json status:

200: {"status":"OK"}
500: {"status:"ERROR - No Site Node Found"}
