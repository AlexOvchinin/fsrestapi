# fsrestapi
File system RESTful API

## Queries
### 1. /GET
#### 1.1 /GET/{path}
Gets {path} file content
#### 1.2 /GET/metadata/{path}
Gets {path} file metadata
### 2. /SET/{path}
Sets {path} file content
### 3. /PUT/{path}
Sets {path} file content. Creates it if it didn't exist
### 4. /DELETE/{path}
Deletes {path} file