#!/bin/bash

# Login to Azure CLI
az login --service-principal -u $AZURE_CLIENT_ID -p $AZURE_CLIENT_SECRET --tenant $AZURE_TENANT_ID

# Deploy the application
az webapp deploy --resource-group $AZURE_RESOURCE_GROUP --name $AZURE_APP_NAME --src-path ./my-app.zip
