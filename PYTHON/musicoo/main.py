import customtkinter as ctk
from PIL import Image, ImageTk

def create_fullscreen_window():
    ctk.set_appearance_mode("Dark")
    ctk.set_default_color_theme("blue")
    app = ctk.CTk()

    screen_width = app.winfo_screenwidth()
    screen_height = app.winfo_screenheight()

    app.geometry(f"{screen_width}x{screen_height}+0+0")
    app.title("Musicoo")
    
    return app

def draw_UI(app):
    left_frame = ctk.CTkFrame(app, corner_radius=0)
    left_frame.grid(row=0, column=0, sticky="nsew")
    left_frame.configure(fg_color="#6D6D6D")

    top_left_frame = ctk.CTkFrame(left_frame, corner_radius=0)
    top_left_frame.grid(row=0, column=0, sticky="nsew")
    top_left_frame.configure(fg_color="#888888")

    bottom_left_frame = ctk.CTkFrame(left_frame, corner_radius=0)
    bottom_left_frame.grid(row=1, column=0, sticky="ew")
    bottom_left_frame.configure(fg_color="#AAAAAA")
    bottom_left_frame.configure(height=85)

    right_frame = ctk.CTkFrame(app, corner_radius=0)
    right_frame.grid(row=0, column=1, sticky="nsew") 
    right_frame.configure(fg_color="#444444")
    
    app.grid_columnconfigure(0, weight=8)
    app.grid_columnconfigure(1, weight=2) 
    app.grid_rowconfigure(0, weight=1)

    left_frame.grid_rowconfigure(0, weight=1)
    left_frame.grid_rowconfigure(1, weight=0)
    
    left_frame.grid_columnconfigure(0, weight=1)

    # ================== top_left_frame ==================

    # Chargement de l'image pour top_left_frame
    top_image = Image.open("assets/icons/AustriaOpera.jpg")
    top_image = top_image.resize((app.winfo_width(), app.winfo_height()))
    top_photo = ImageTk.PhotoImage(top_image)

    # Ajout de l'image à top_left_frame
    image_label = ctk.CTkLabel(top_left_frame, image=top_photo)
    image_label.image = top_photo
    image_label.pack(fill="both", expand=True)

    # ================== bottom_left_frame ==================
    
    slider = ctk.CTkSlider(bottom_left_frame, from_=0, to=100)
    slider.pack(fill="x", padx=5, pady=5)

    # Ajout d'un cadre pour les boutons et le texte
    button_frame = ctk.CTkFrame(bottom_left_frame, corner_radius=0)
    button_frame.pack(fill="x", padx=5, pady=(0, 5))  # Remplir horizontalement avec des marges

    # Chargement des images pour les boutons
    img1 = Image.open("assets/icons/app_icon-100.jpg")
    img2 = Image.open("assets/icons/app_icon-100.jpg")
    img3 = Image.open("assets/icons/app_icon-100.jpg")
    img4 = Image.open("assets/icons/app_icon-100.jpg")
    
    # Redimensionner les images
    img1 = img1.resize((40, 40))
    img2 = img2.resize((40, 40))
    img3 = img3.resize((40, 40))
    img4 = img4.resize((40, 40))
    
    # Conversion des images en PhotoImage
    photo1 = ImageTk.PhotoImage(img1)
    photo2 = ImageTk.PhotoImage(img2)
    photo3 = ImageTk.PhotoImage(img3)
    photo4 = ImageTk.PhotoImage(img4)

    # Création des boutons avec images
    button1 = ctk.CTkButton(button_frame, image=photo1, text="", command=lambda: print("Button 1 clicked"))
    button1.pack(side="left", padx=5)

    button2 = ctk.CTkButton(button_frame, image=photo2, text="", command=lambda: print("Button 2 clicked"))
    button2.pack(side="left", padx=5)

    button3 = ctk.CTkButton(button_frame, image=photo3, text="", command=lambda: print("Button 3 clicked"))
    button3.pack(side="left", padx=5)

    button4 = ctk.CTkButton(button_frame, image=photo4, text="", command=lambda: print("Button 4 clicked"))
    button4.pack(side="left", padx=5)

    # Ajout d'un texte à la suite des boutons
    text_label = ctk.CTkLabel(button_frame, text="Texte à afficher", anchor="w")
    text_label.pack(side="left", padx=(10, 0))



if __name__ == "__main__":
    app = create_fullscreen_window()
    draw_UI(app)
    app.mainloop()
