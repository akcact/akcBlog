resource "aws_instance" "wordpress" {

  ami = data.aws_ami.ubuntu.id

  instance_type = var.instance_type

  subnet_id = aws_subnet.public.id

  vpc_security_group_ids = [

    aws_security_group.main.id

  ]

  key_name = aws_key_pair.wordpress.key_name

  associate_public_ip_address = true

  user_data = file("${path.module}/userdata.sh")

  root_block_device {

    volume_size = 30

    volume_type = "gp3"

    delete_on_termination = true

  }

  tags = merge(

    local.common_tags,

    {

      Name = "${var.project_name}-server"

    }

  )

}
