from tkinter import *
import webbrowser

def open_channel():
    webbrowser.open_new("http://youtube.com")

window = Tk()

window.title("My Application")
window.geometry("1080x720")
window.minsize(480, 360)
#window.iconbitmap("ressources/logo.ico")
window.config(background='#41B77F')

frame = Frame(window, bg='#41B77F', bd=1, relief=SUNKEN)

#ajouter un premier texte
label_title = Label(frame, text="Bienvenue sur l'application", font=("Arial", 40), bg='#41B77F', fg='white')
label_title.pack()

#ajouter un second texte
label_subtitle = Label(frame, text="Hey salut à tous !", font=("Arial", 20), bg='#41B77F', fg='white')
label_subtitle.pack()

yt_button = Button(frame, text="cliquez ici", font=("Arial", 40), bg='white', fg='#41B77F', command=open_channel)
yt_button.pack(pady=25, fill=X)

frame.pack(expand=YES)

window.mainloop()