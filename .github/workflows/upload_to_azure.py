- name: Upload to Azure Storage
  env:
    AZURE_STORAGE_CONNECTION_STRING: ${{ secrets.AZURE_STORAGE_CONNECTION_STRING }}
  run: |
    python scripts/upload_to_azure.py
