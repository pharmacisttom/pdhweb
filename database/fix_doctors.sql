UPDATE doctors SET prefix='พญ.', firstname='สมหญิง', lastname='ใจดี', specialty='อายุรกรรมทั่วไป' WHERE id=1;
UPDATE doctors SET prefix='นพ.', firstname='สมชาย', lastname='รักความสุข', specialty='ศัลยกรรมกระดูก' WHERE id=2;
DELETE FROM doctors WHERE id IN (3, 4);
