# CourseSquareAPI
## ขั้นตอนการลง
<ol>
    <li>โคลน project</li>
    <li>พิมพ์คำสั่ง composer i </li>
    <li>พิมพ์คำสั่ง php artisan migrate เพื่อทำการ migrate database</li>
    <li>พิมพ์คำสั่ง php artisan serve เพื่อทำการรันตัว server</li>
</ol>

## Route
### Member
| Method | Route | Json Input | Description |
| - | - | - | - |
| GET | /members | - | Get all members |
| POST | /members | { <br>"m_email" : string, <br> "m_password" : string, <br> "m_name" : string <br>} | Create new member |
| GET | /members/{m_id} | - | Get specified member info |
| PUT | /members/{m_id} | { <br>"m_email" : string, <br> "m_password" : string, <br> "m_name" : string <br>} | Update specified member |
| Delete | /members/{m_id} | - | delete specified member |

### Course
| Method | Route | Json Input | Description |
| - | - | - | - |
| GET | /courses | - | Get all courses |
| POST | /courses | { <br>"c_name" : string, <br> "c_description" : string, <br> "c_price" : number <br>} | Create new course |
| GET | /courses/{c_id} | - | Get specified course info |
| PUT | /courses/{c_id} | { <br>"c_name" : string, <br> "c_description" : string, <br> "c_price" : number <br>} | Update specified course |
| Delete | /courses/{c_id} | - | delete specified course | 

### Enroll
| Method | Route | Json Input | Description |
| - | - | - | - |
| GET | /enrolls | - | Get all course enrolls |
| POST | /enrolls | { <br>"m_id" : integer <br> "c_id" : integer <br> "cer_start" : date <br> "cer_expire" : date <br> } | Create new course enroll |
| GET | /enrolls/{cer_id} | - | Get specified enroll info |
| PUT | /enrolls/{cer_id} | { <br>"m_id" : integer <br> "c_id" : integer <br> "cer_start" : date <br> "cer_expire" : date <br> } | Update specified enroll |
| Delete | /enrolls/{cer_id} | - | delete specified enroll info | 
| GET | /enrolls/member/{m_id} | - | Get all course enrolls of specified member | 
| GET | /enrolls/course/{c_id} | - | Get all course enrolls of specified course |
