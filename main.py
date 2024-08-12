import tkinter as tk
from tkinter import messagebox

# Function to validate login credentials
def validate_login():
    username = username_entry.get()
    password = password_entry.get()

    if username == "admin" and password == "password":
        messagebox.showinfo("Login Successful", "Welcome, Admin!")
    else:
        messagebox.showerror("Login Failed", "Invalid Username or Password")

# Create the main window
root = tk.Tk()
root.title("Login Interface")
root.geometry("300x200")

# Create a label and entry for the username
username_label = tk.Label(root, text="Username:")
username_label.pack(pady=5)
username_entry = tk.Entry(root)
username_entry.pack(pady=5)

# Create a label and entry for the password
password_label = tk.Label(root, text="Password:")
password_label.pack(pady=5)
password_entry = tk.Entry(root, show="*")
password_entry.pack(pady=5)

# Create a login button
login_button = tk.Button(root, text="Login", command=validate_login)
login_button.pack(pady=20)

# Run the main event loop
root.mainloop()
