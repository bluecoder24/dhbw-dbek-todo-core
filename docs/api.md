# API
## Routes

### User ###

#### GET /getUser/{userId} ####

### Task ###

#### GET /getTasksOfList/{listId} ####

Response: (todo)

#### GET /getTaskById/{taskId} ####

#### POST /addOrUpdateTask ####

Body: (todo)
If id is null, create new task

### Tasklist ###

#### GET /getListsByUserId/{userId} ####

Response: (# POST-getListsByUserId-body)

#### POST /addOrUpdateList ####

Body: name, id

## Request bodies ##

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