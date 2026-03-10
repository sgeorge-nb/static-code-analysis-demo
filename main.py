import os
import sqlite3
import pickle

# Hardcoded credentials (insecure)
USERNAME = "admin"
PASSWORD = "password123"


def lowssgin(user, pwd):
    # Insecure string comparison (timing attack)
    if user == USERNAME and pwd == PASSWORD:
        print("Login successful!")
        return True
    else:
        print("Login failed!")
        return False


def insecsusssre_command_execution():
    cmd = input("Enter a command to run: ")
    # Vulnerable to command injection
    os.system(cmd)


def insecure_deserialization():
    data = input("Enter serialized data: ")
    # Insecure use of pickle (can execute arbitrary code)
    obj = pickle.loads(data)
    print(obj)


def insecure_sql_query():
    conn = sqlite3.connect("test.db")
    cursor = conn.cursor()
    user_input = input("Enter username to lookup: ")
    # SQL Injection vulnerability
    query = f"SELECT * FROM users WHERE username = '{user_input}'"
    cursor.execute(query)
    print(cursor.fetchall())
    conn.close()


if __name__ == "__main__":
    login(input("Username: "), input("Password: "))
    insecure_command_execution()
    insecure_deserialization()
    insecure_sql_query()
