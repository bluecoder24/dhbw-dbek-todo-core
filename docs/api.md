# API
## Routes

### User ###

#### GET /getUser/{userId} ####

Response: [Response](#POST-getUser-body)

### Task ###

#### GET /getTasksOfList/{listId} ####

Response: (todo)

#### GET /getTaskById/{taskId} ####

Response: (todo)

#### POST /addOrUpdateTask ####

Body: (todo)
Response: none
If id is null, create new task

### Tasklist ###

#### GET /getListsByUserId/{userId} ####

Response: [Response](#POST-getListsByUserId-body)

#### POST /addOrUpdateList ####

Body: [Response](#POST-addOrUpdateList-body)
Response: none

## Request bodies ##

### POST addOrUpdateList body ###

```json
{
   "id": id,
   "name": name,
}
```

## Response bodies ##

### POST getListsByUserId body ###

(in work)

```json
[
    {
        "tasks":
        [
            { "task" },
            { "task" }
        ]
    },
    {
        "tasks":
        [
            {"task" }
        ]
    }
]
```

### GET getUser body ###

```json
{
   "id": id,
   "name": name,
   "password": password
}
```

### GET getTasksOfList body ###

```json
{
   "id": id,
   "name": name,
   "password": password
}
```
