#!/usr/bin/env python
#Load an xml library
import xml.etree.ElementTree as ET
#load a random number generator
import random
random.seed() #Always seed your generator!

#Load the XML file
XMLFile = ET.parse("config.HS.xml")

#Add the diameter and mass tags
for ParticleTag in XMLFile.findall("./ParticleData/Pt"):
    #Calculate a random diameter
    diameter = random.uniform(0.1, 1)
    #Add attributes for the diameter
    ParticleTag.attrib["D"] = str(diameter)
    #Add a mass attribute which scales with the particle volume (for D=1 M=1)
    ParticleTag.attrib["M"] = str(diameter * diameter * diameter)

#Tell DynamO about these properties
massProperty = ET.SubElement(XMLFile.findall("./Properties")[0], "Property")
massProperty.attrib["Type"] = "PerParticle"
massProperty.attrib["Units"] = "Mass"
massProperty.attrib["Name"] = "M"
diamProperty = ET.SubElement(XMLFile.findall("./Properties")[0], "Property")
diamProperty.attrib["Type"] = "PerParticle"
diamProperty.attrib["Units"] = "Length"
diamProperty.attrib["Name"] = "D"

#Change the Interaction and Species to use the properties
XMLFile.findall(".//Interaction")[0].attrib["Diameter"] = "D"
XMLFile.findall(".//Species")[0].attrib["Mass"] = "M"

#Write out XML file
XMLFile.write("config.poly.xml",xml_declaration=True)
