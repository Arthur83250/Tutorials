from tkinter import *

window = Tk()
window.title("Générateur de mot de passe")
window.geometry("720x480")
window.config(background='#41B77F')

#frame principale
frame = Frame(window, bg='#41B77F')
frame.grid(row=1, column=2)

#creation d'image
width = 300
height = 300
image = PhotoImage(file="Earth.png")
canvas = Canvas(window, width=width, height=height, bg='#41B77F')
canvas.create_image(width/2, height/2, image=image)
canvas.grid(row=0, column=0, sticky=W)

#creer un titre
label_title = Label(frame, text="mot de passe", font=("Helvetica", 20), bg='#41B77F', fg='white')
label_title.grid(row=0, column=1, sticky=W)

window.mainloop()