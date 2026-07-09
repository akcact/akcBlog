resource "aws_key_pair" "wordpress" {
  key_name   = var.key_name
  public_key = file("${path.module}/wordpress-akc.pub")
}
