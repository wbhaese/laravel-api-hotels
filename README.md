##Command to import CSV file

php artisan import:hotels

## Hotel API

List of endpoints and response.

---------------------------------------------------
Return  id, hotel name and city of all hotels on system.

Endpoint: hotels/ 

method: GET

---------------------------------------------------
Return all collumns of a single hotel

Endpoint: /hotels/{id} 

method: GET

---------------------------------------------------
Save a single hotel on database

Endpoint: /hotels/

method: POST
---------------------------------------------------
To update an hotel, just send the Id and what data to update

Endpoint: /hotels/{id}/edit

method: PUT

---------------------------------------------------
This last option delete hotel by Id.

Endpoint: /hotels/{id}

method: DELETE

---------------------------------------------------

*all exceptions are saved on Logs and a generic error message return 
