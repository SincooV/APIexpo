I learned how to Dockerize a Laravel application and create endpoints within the framework. I created migrations for three related tables. Essentially, this project is a student attendance list where you can store students, classrooms, and attendance records for users/students.
The database works as follows: users have a foreign key from the classrooms table, so students are associated with classrooms. Additionally, there is a presence table that records student IDs and timestamps for attendance, including a created_at column.
I implemented a backend union to display attendance records along with the user ID and class ID. There's a specific endpoint called presentes/{turmaid} that allows you to check who was present in a given classroom identified by {turmaid}. This turmaid is a unique string derived from the students' classroom table. It combines three values: year, year_class, and name. The name can be A, B, C, or, if it’s a course, you might use Info, ADS, Cybersecurity, etc. The year represents the high school year, as this model is designed for Brazilian high schools with technical courses that last three years—freshman, sophomore, and senior—since there is no fourth year in Brazil.

This model summarizes the three values. For example, for a classroom with:
```json
{
  "name": "info",
  "year": 1,
  "year_class": 2024
}
```
The generated class identifier would be info12024. When stored, it appears as:

```json
{
  "name": "info",
  "year": 1,
  "year_class": 2024,
  "class": "1info2024"
}
```
In this case, class represents the {turmaid}.
