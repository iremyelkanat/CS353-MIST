with open("./data.txt") as data:
    readData = data.read()
    readData = readData.replace("\"", "'")

with open("./output.txt", "w") as writer:
    writer.write(readData)