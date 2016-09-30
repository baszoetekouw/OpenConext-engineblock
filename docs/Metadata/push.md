# Metadata Push

As of EngineBlock 5, the metadata repository will always be database backed. Metadata can only be provisioned through
the metadata push api.

## Flow

When pushing a new metadata set to the Metadata Push API it goes through the following steps:

1. Convert JSON to datastructure
2. Verify integrity and completeness of datastructure
3. Convert datastructure to Metadata 
4. Create new connection objects
5. Open Transaction
6. Remove all existing connections and service configurations
7. 

## Metadata Push Api

url:
expected data struct:

## Security

