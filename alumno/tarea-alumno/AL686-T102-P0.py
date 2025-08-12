def menu():
    print("Área y perímetro de figuras geométricas")
    print("1. Triángulo")
    print("2. Rectángulo")
    print("3. Círculo")
    print("4. Polígono")
    print("5. Salir")
    figura = int(input("Seleccione una opción: "))
    area_perimetro(figura)

def area_perimetro(figura):
    if figura < 5:
        print("Seleccione la opción 1 o 2")
        print("1. Área")
        print("2. Perímetro")
        operacion = int(input("Seleccione una opción: "))
        if figura == 1:
            if operacion == 1:
                areatriangulo()
            elif operacion == 2:
                perimetrotriangulo()
        elif figura == 2:
            if operacion == 1:
                arearectangulo()
            elif operacion == 2:
                perimetrorectangulo()
        elif figura == 3:
            if operacion == 1:
                areacirculo()
            elif operacion == 2:
                perimetrocirculo()
        elif figura == 4:
            if operacion == 1:
                areapoligono()
            elif operacion == 2:
                perimetro_poligono()
    else:
        print("Saliendo...")
        exit()

def areatriangulo():
    print("Área del triángulo")
    base = int(input("Escriba la medida de la base: "))
    altura = int(input("Escriba la medida de la altura: "))
    resultado = base * altura / 2
    print("El área del triángulo es:", resultado)
    menu()

def perimetrotriangulo():
    print("Perímetro del triángulo")
    lado1 = int(input("Escriba el lado 1: "))
    lado2 = int(input("Escriba el lado 2: "))
    lado3 = int(input("Escriba el lado 3: "))
    resultado = lado1 + lado2 + lado3
    print("El perímetro del triángulo es:", resultado)
    menu()

def arearectangulo():
    print("Área del rectángulo")
    base = int(input("Escriba la medida de la base: "))
    altura = int(input("Escriba la medida de la altura: "))
    resultado = base * altura
    print("El área del rectángulo es:", resultado)
    menu()

def perimetrorectangulo():
    print("Perímetro del rectángulo")
    lado1 = int(input("Escriba el lado 1: "))
    lado2 = int(input("Escriba el lado 2: "))
    resultado = 2 * (lado1 + lado2)
    print("El perímetro del rectángulo es:", resultado)
    menu()

def areacirculo():
    print("Área del círculo")
    radio = int(input("Escriba la medida del radio: "))
    resultado = 3.1416 * radio ** 2
    print("El área del círculo es:", resultado)
    menu()

def perimetrocirculo():
    print("Perímetro del círculo")
    diametro = int(input("Escriba la medida del diámetro: "))
    resultado = 3.1416 * diametro
    print("El perímetro del círculo es:", resultado)
    menu()

def areapoligono():
    print("Área del polígono")
    perimetro = int(input("Escriba el perímetro del polígono: "))
    apotema = int(input("Escriba la medida de la apotema: "))
    resultado = perimetro * apotema / 2
    print("El área del polígono es:", resultado)
    menu()

def perimetro_poligono():
    print("Perímetro del polígono")
    lados = int(input("Escriba el número de lados del polígono: "))
    lado = int(input("Escriba la medida de un lado del polígono: "))
    resultado = lados * lado
    print("El perímetro del polígono es:", resultado)
    menu()

menu()