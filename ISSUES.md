# Known issues

This implementation has big performance issue on big number of houses.

Searching for a house by name using LIKE-expressions is slow due to full table scans.
Performance can be improved by using FTS (ex. PostgreSQL's default) or at least limiting search by name to "starts with..." concept. 
