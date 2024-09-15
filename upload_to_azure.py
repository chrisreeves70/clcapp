from azure.storage.blob import BlobServiceClient
import os

# Retrieve the connection string from environment variable
connection_string = os.getenv("AZURE_STORAGE_CONNECTION_STRING")

if not connection_string:
    raise ValueError("AZURE_STORAGE_CONNECTION_STRING environment variable is not set.")

# Define the container name and directory path
container_name = "blob"  # Blob container name created
local_directory = "/home/runner/work/clcapp/clcapp"  # Directory path relative to GitHub Actions workspace

# Create a BlobServiceClient using the connection string
blob_service_client = BlobServiceClient.from_connection_string(connection_string)

# Get a container client
container_client = blob_service_client.get_container_client(container_name)

# Check if the container exists, if not create it
try:
    container_client.create_container()
except Exception as e:
    print(f"Container already exists or error occurred: {e}")

# Upload all files in the directory to the blob container
for root, dirs, files in os.walk(local_directory):
    for file_name in files:
        local_file_path = os.path.join(root, file_name)
        blob_name = os.path.relpath(local_file_path, local_directory).replace("\\", "/")  # Relative path in blob

        try:
            with open(local_file_path, "rb") as data:
                blob_client = container_client.get_blob_client(blob_name)
                blob_client.upload_blob(data, overwrite=True)  # Overwrite if the blob already exists
                print(f"File '{local_file_path}' uploaded to blob '{blob_name}' successfully.")
        except Exception as e:
            print(f"Failed to upload file '{local_file_path}': {e}")
